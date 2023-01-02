import fs from "fs";
import laravel from "laravel-vite-plugin";
import { defineConfig } from "vite";
import { homedir } from "os";
import { resolve } from "path";

let hosts = ["order.test", "software.test"];

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/sass/app.scss",
                "resources/js/app.js",
            ],
            refresh: true,
        }),
    ],
    server: detectServerConfig(hosts),
});

function detectServerConfig(hosts) {
    for (let host of hosts) {
        let keyPath = resolve(
            homedir(),
            `.config/valet/Certificates/${host}.key`
        );
        let certificatePath = resolve(
            homedir(),
            `.config/valet/Certificates/${host}.crt`
        );

        if (!fs.existsSync(keyPath)) {
            continue;
            return {};
        }

        if (!fs.existsSync(certificatePath)) {
            continue;
            return {};
        }

        return {
            hmr: { host },
            host,
            https: {
                key: fs.readFileSync(keyPath),
                cert: fs.readFileSync(certificatePath),
            },
        };
    }

    return {};
}
