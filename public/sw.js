// PWA
const CACHE_NAME = "siputa-v1.0.0";

const ASSETS = [
    "/offline",
    "/icon.png",
    "/favicon.ico",
    "/pwa/icon-192.png",
    "/pwa/icon-512.png",
    "/img/Loading Screen 2.gif",
    "/img/logo ksb.png",
    "/img/missing-page.gif",
];

self.addEventListener("install", (event) => {
    self.skipWaiting();

    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => cache.addAll(ASSETS))
    );
});

self.addEventListener("activate", (event) => {
    event.waitUntil(
        Promise.all([
            clients.claim(),

            caches.keys().then((keys) =>
                Promise.all(
                    keys.map((key) => {
                        if (key !== CACHE_NAME) {
                            return caches.delete(key);
                        }
                    })
                )
            ),
        ])
    );
});

self.addEventListener("fetch", (event) => {
    if (event.request.method !== "GET") {
        return;
    }

    event.respondWith(
        fetch(event.request).catch(() => {
            if (event.request.mode === "navigate") {
                return caches.match("/offline");
            }
        })
    );
});

// Push Notification
self.addEventListener("push", (event) => {
    notification = event.data.json();
    // { "title": "Hi", "body": "This is a notification", "url": "/?message1" }
    event.waitUntil(
        self.registration.showNotification(notification.title, {
            body: notification.body,
            icon: notification.icon || "icon.png",
            tag: notification.tag || "default",
            // data: notification.data,
            data: {
                notifURL: notification.url,
            },
        })
    );
});

self.addEventListener("notificationclick", (event) => {
    clients.openWindow(event.notification.data.notifURL);
});
