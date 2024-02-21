const mix = require("laravel-mix");
const path = require("path");
const webpack = require("webpack");

mix.js("resources/js/app.js", "public/js")
    .vue()
    .webpackConfig({
        output: { chunkFilename: "js/[name].js?id=[chunkhash]" },
        resolve: {
            alias: {
                "@": path.resolve("./resources/js"),
            },
            extensions: [".js", ".vue", ".json"],
        },
        devServer: {
            allowedHosts: "all",
        },
        plugins: [
            new webpack.DefinePlugin({
                __VUE_PROD_HYDRATION_MISMATCH_DETAILS__: false,
            }),
        ],
    })
    .postCss("resources/css/app.css", "public/css", [
        require("postcss-import"),
        require("tailwindcss"),
        require("autoprefixer"),
    ]);
