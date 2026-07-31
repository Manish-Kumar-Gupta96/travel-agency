import js from "@eslint/js";
import globals from "globals";
import reactHooks from "eslint-plugin-react-hooks";
import reactRefresh from "eslint-plugin-react-refresh";
import reactPlugin from "eslint-plugin-react";

export default [
    {
        ignores: [
            "dist",
            "node_modules",
            "coverage",
            ".vite"
        ]
    },

    js.configs.recommended,

    {
        files: ["**/*.{js,jsx}"],

        languageOptions: {

            ecmaVersion: "latest",

            sourceType: "module",

            globals: {
                ...globals.browser,
                ...globals.node
            },

            parserOptions: {
                ecmaFeatures: {
                    jsx: true
                }
            }
        },

        plugins: {
            react: reactPlugin,
            "react-hooks": reactHooks,
            "react-refresh": reactRefresh
        },

        settings: {
            react: {
                version: "detect"
            }
        },

        rules: {

            "no-console": "warn",

            "no-unused-vars": [
                "warn",
                {
                    argsIgnorePattern: "^_"
                }
            ],

            "react/react-in-jsx-scope": "off",

            "react/jsx-uses-react": "off",

            "react/jsx-uses-vars": "error",

            "react/self-closing-comp": "warn",

            "react-hooks/rules-of-hooks": "error",

            "react-hooks/exhaustive-deps": "warn",

            "react-refresh/only-export-components": [
                "warn",
                {
                    allowConstantExport: true
                }
            ]
        }
    }
];
