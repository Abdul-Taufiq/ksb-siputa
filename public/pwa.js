// {{-- isntall PWA --}}

let deferredPrompt = null;

const installContainer = document.getElementById("installAppContainer");
const installButton = document.getElementById("btnInstallApp");

const isIOS = /iphone|ipad|ipod/i.test(navigator.userAgent);

const isStandalone =
    window.matchMedia("(display-mode: standalone)").matches ||
    window.navigator.standalone === true;

// ==============================
// Jika sudah terinstall
// ==============================

if (isStandalone) {
    installContainer.style.display = "none";
} else {
    // Safari
    if (isIOS) {
        installContainer.style.display = "block";
    }
}

// ==============================
// Chrome / Android
// ==============================

window.addEventListener("beforeinstallprompt", (e) => {
    e.preventDefault();

    deferredPrompt = e;

    installContainer.style.display = "block";
});

// ==============================
// Tombol Install
// ==============================

installButton.addEventListener("click", async function (e) {
    e.preventDefault();

    // iPhone
    if (isIOS) {
        Swal.fire({
            icon: "info",
            title: "Install Si-Puta",
            html: `
                <div style="text-align:left">
                    <b>Cara Install di iPhone</b><br><br>

                    1️⃣ Tekan tombol <b>Share</b> Safari<br>

                    2️⃣ Pilih <b>Add to Home Screen</b><br>

                    3️⃣ Tekan <b>Add</b><br>
                </div>
            `,
        });

        return;
    }

    // Android
    if (!deferredPrompt) {
        Swal.fire({
            icon: "warning",
            title: "Belum Bisa Diinstall",
            text: "Browser belum mengizinkan install aplikasi. Coba gunakan aplikasi beberapa saat lalu buka kembali.",
        });

        return;
    }

    deferredPrompt.prompt();

    const result = await deferredPrompt.userChoice;

    if (result.outcome === "accepted") {
        console.log("Install diterima");
    }

    deferredPrompt = null;
});

// ==============================
// Setelah berhasil install
// ==============================

window.addEventListener("appinstalled", () => {
    installContainer.style.display = "none";

    deferredPrompt = null;

    Swal.fire({
        icon: "success",
        title: "Berhasil",
        text: "Si-Puta berhasil diinstall.",
    });
});

// =================================
// =================================
// =================================
// {{-- PUSH NOTIF --}}
const VAPID_PUBLIC_KEY = "{{ config('webpush.vapid.public_key') }}";

// otomatis saat load
// document.addEventListener("DOMContentLoaded", async () => {
//     if (!("Notification" in window)) {
//         console.warn("Browser tidak mendukung Notification API.");
//         return;
//     }

//     if (!("serviceWorker" in navigator)) {
//         console.warn("Browser tidak mendukung Service Worker.");
//         return;
//     }

//     try {
//         // Register Service Worker
//         const registration = await navigator.serviceWorker.register("/sw.js", {
//             scope: "/"
//         });
//         console.log("✅ Service Worker Registered");
//         await requestPermission();
//     } catch (err) {
//         console.error(err);
//     }
// });

// dibantu button
document
    .getElementById("enableNotification")
    .addEventListener("click", async () => {
        if (!("Notification" in window)) {
            console.warn("Browser tidak mendukung Notification API.");
            Swal.fire({
                title: "Browser Tidak Mendukung!",
                html: "Browser tidak mendukung Notification API.",
                icon: "error",
                confirmButtonText: "OK",
            });
            return;
        }

        if (!("serviceWorker" in navigator)) {
            console.warn("Browser tidak mendukung Service Worker.");
            Swal.fire({
                title: "Browser Tidak Mendukung!",
                html: "Browser tidak mendukung Service Worker.",
                icon: "error",
                confirmButtonText: "OK",
            });
            return;
        }

        try {
            // Register Service Worker
            const registration = await navigator.serviceWorker.register(
                "/sw.js",
                {
                    scope: "/",
                }
            );
            console.log("✅ Service Worker Registered");
            Swal.fire({
                title: "Service Worker Device Berhasil Didaftarkan",
                html: "Silakan izinkan notifikasi.",
                icon: "success",
                confirmButtonText: "OK",
            });
            await requestPermission();
        } catch (err) {
            console.error(err);
        }
    });

async function requestPermission() {
    const permission = await Notification.requestPermission();
    if (permission !== "granted") {
        console.warn("Notification Permission Ditolak.");
        Swal.fire({
            title: "Perizinan Notifikasi Ditolak",
            html: "Silakan izinkan notifikasi agar aplikasi <b>Si-Puta</b> dapat mengirimkan notifikasi ke perangkat Anda.",
            icon: "error",
            confirmButtonText: "OK",
        });

        return;
    }
    const registration = await navigator.serviceWorker.ready;
    // Cek apakah sudah pernah subscribe
    let subscription = await registration.pushManager.getSubscription();

    if (!subscription) {
        subscription = await registration.pushManager.subscribe({
            userVisibleOnly: true,
            applicationServerKey: urlBase64ToUint8Array(VAPID_PUBLIC_KEY),
        });
        console.log("✅ Device berhasil subscribe.");
    } else {
        console.log("ℹ️ Device sudah subscribe.");
    }
    saveSubscription(subscription);
}

async function saveSubscription(subscription) {
    console.log("🚀 saveSubscription dipanggil");
    const browser = await getBrowser();
    try {
        // const payload = {
        //     endpoint: subscription.endpoint,
        //     keys: subscription.toJSON().keys,
        //     device_id: getDeviceId(),
        //     device_name: getDeviceName(),
        //     browser: getBrowser(),
        //     platform: getPlatform(),
        //     user_agent: navigator.userAgent
        // };

        // console.log(payload);
        const response = await fetch("/push-subscribe", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
            },

            body: JSON.stringify({
                endpoint: subscription.endpoint,
                keys: subscription.toJSON().keys,
                device_name: `${getPlatform()} - ${browser}`,
                browser: browser,
                platform: getPlatform(),
                user_agent: navigator.userAgent,
                device_id: getDeviceId(),
            }),
        });
        const result = await response.json();
        // console.log(result);
        Swal.fire({
            title: "Yeaayy, Notifikasi Berhasil Diaktifkan",
            html: "Terimakasih telah mengaktifkan notifikasi, Anda akan menerima notifikasi dari aplikasi <b>Si-Puta</b>. <br> Have a good day! 😘",
            icon: "success",
            confirmButtonText: "OK",
        });
    } catch (err) {
        console.error(err);
    }
}

async function getBrowser() {
    // Brave
    if (navigator.brave && (await navigator.brave.isBrave())) {
        return "Brave";
    }

    const ua = navigator.userAgent;
    if (ua.includes("Edg")) return "Microsoft Edge";
    if (ua.includes("OPR")) return "Opera";
    if (ua.includes("Firefox")) return "Mozilla Firefox";
    if (ua.includes("Chrome")) return "Google Chrome";
    if (ua.includes("Safari")) return "Safari";
    return "Unknown";
}

function getPlatform() {
    const ua = navigator.userAgent;
    if (/Android/i.test(ua)) return "Android";
    if (/iPhone|iPad|iPod/i.test(ua)) return "iOS";
    if (/Win/i.test(ua)) return "Windows";
    if (/Mac/i.test(ua)) return "macOS";
    if (/Linux/i.test(ua)) return "Linux";
    return "Unknown";
}

function urlBase64ToUint8Array(base64String) {
    const padding = "=".repeat((4 - (base64String.length % 4)) % 4);
    const base64 = (base64String + padding)
        .replace(/-/g, "+")
        .replace(/_/g, "/");
    const rawData = window.atob(base64);
    const outputArray = new Uint8Array(rawData.length);
    for (let i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i);
    }

    return outputArray;
}

function getDeviceId() {
    let deviceId = localStorage.getItem("device_id");
    if (!deviceId) {
        deviceId = crypto.randomUUID();
        localStorage.setItem("device_id", deviceId);
    }
    return deviceId;
}
// {{-- END PUSH NOTIF --}}
