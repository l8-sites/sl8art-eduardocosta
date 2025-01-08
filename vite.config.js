import legacy from '@vitejs/plugin-legacy'
import {defineConfig, loadEnv} from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import {ViteMinifyPlugin} from 'vite-plugin-minify'
import {viteS3} from 'vite-plugin-s3';
import {VitePWA} from 'vite-plugin-pwa'
import htmlMinimize from '@sergeymakinen/vite-plugin-html-minimize'
import {terser} from 'rollup-plugin-terser';
import path from "path";
const APP_URL = process.env.APP_URL || '';
const env = loadEnv('env', process.cwd(), '');

export default defineConfig({
    plugins: [
        viteS3({
            uploadEnabled: env.APP_ENV !== 'local' ? !!env.UPLOAD_ENABLED : '',
            s3Options: {
                accessKeyId: env.APP_ENV !== 'local' ? env.AWS_ACCESS_KEY_ID : '',
                secretAccessKey: env.APP_ENV !== 'local' ? env.AWS_SECRET_ACCESS_KEY : '',
                region: env.APP_ENV !== 'local' ? env.AWS_DEFAULT_REGION : '',
            },
            s3UploadOptions: {
                Bucket: env.APP_ENV !== 'local' ? env.AWS_BUCKET_BUILD : '',
                CacheControl: 'public, max-age=180, must-revalidate, proxy-revalidate',
            },
            basePath: env.APP_ENV !== 'local' ? '/site/' + env.VITE_API_CLIENT_ID + '/build' : '',
        }),
        viteS3({
            uploadEnabled: env.APP_ENV !== 'local' ? !!env.UPLOAD_ENABLED : '',
            s3Options: {
                accessKeyId: env.APP_ENV !== 'local' ? env.AWS_ACCESS_KEY_ID : '',
                secretAccessKey: env.APP_ENV !== 'local' ? env.AWS_SECRET_ACCESS_KEY : '',
                region: env.APP_ENV !== 'local' ? env.AWS_DEFAULT_REGION : '',
            },
            s3UploadOptions: {
                Bucket: env.APP_ENV !== 'local' ? env.AWS_BUCKET_BUILD : '',
                CacheControl: 'public, max-age=180, must-revalidate, proxy-revalidate'
            },
            uploadDir: path.resolve(__dirname, 'public/images'),
            basePath: env.APP_ENV !== 'local' ? '/site/' + env.VITE_API_CLIENT_ID + '/build/assets/images' : ''
        }),
        viteS3({
            uploadEnabled: env.APP_ENV !== 'local' ? !!env.UPLOAD_ENABLED : '',
            s3Options: {
                accessKeyId: env.APP_ENV !== 'local' ? env.AWS_ACCESS_KEY_ID : '',
                secretAccessKey: env.APP_ENV !== 'local' ? env.AWS_SECRET_ACCESS_KEY : '',
                region: env.APP_ENV !== 'local' ? env.AWS_DEFAULT_REGION : '',
            },
            s3UploadOptions: {
                Bucket: env.APP_ENV !== 'local' ? env.AWS_BUCKET_BUILD : '',
                CacheControl: 'public, max-age=180, must-revalidate, proxy-revalidate'
            },
            uploadDir: path.resolve(__dirname, 'public/fonts'),
            basePath: env.APP_ENV !== 'local' ? '/site/' + env.VITE_API_CLIENT_ID + '/build/assets/fonts' : ''
        }),
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        ViteMinifyPlugin(),
        htmlMinimize({
            filter: /\.x?html?$/
        }),
        /*VitePWA({
            includeAssets: ['favicon.png', 'apple-touch-icon.png', 'mask-icon.png'],
            manifest: {
                name: env.APP_NAME + ' App',
                short_name: env.APP_NAME,
                id: "/",
                start_url: "/",
                scope: "/",
                display_override: ["fullscreen", "minimal-ui"],
                orientation: "any",
                display: "standalone",
                description: '',
                theme_color: '#ffffff',
                background_color: "#FFFFFF",
                prefer_related_applications: false,
                features: [
                    "Cross Platform",
                    "low-latency inking",
                    "fast",
                    "useful AI"
                ],
                icons: [
                    {
                        src: '/images/icon-app.png',
                        sizes: '150x150',
                        type: 'image/png',
                        purpose: "any"
                    },
                    {
                        "src": "/images/icon-app.png",
                        "sizes": "150x150",
                        "type": "image/png",
                        "purpose": "maskable"
                    },
                    {
                        src: '/images/icon-app-512x512.png',
                        sizes: '512x512',
                        type: 'image/png',
                        purpose: "any"
                    }
                ],
                screenshots: [
                    {
                        "src": "https://is1-ssl.mzstatic.com/image/thumb/PurpleSource126/v4/56/e0/53/56e0539f-b610-356c-5d2b-0bec35b4cef7/c9b2c423-99e1-4489-acb2-812a5c7152fc_tela-6.7-1.png/230x0w.webp"
                    },
                ],
            }
        }),*/
        /*legacy({
            target: ['web', 'es2017'],
        }),*/
        {
            apply: 'build',
            ...terser({
                compress: {
                    drop_console: true,
                    pure_funcs: ['console.log']
                },
                output: {
                    comments: false
                }
            })
        }
    ],
    base: `${APP_URL}`,
    optimizeDeps: {
        esbuildOptions: {
            target: ['es2020', 'safari14'],
        },
    },
    build: {
        chunkSizeWarningLimit: 1600,
        sourcemap: true,
        minify: true,
        cssMinify: true,
        target: ['es2020', 'safari14'],
    },
});
