import { writable } from "svelte/store";

const html = document.documentElement;

const systemIsDark = window.matchMedia(
    "(prefers-colors-scheme: dark)",
).matches;

let current = localStorage.getItem("color-scheme");

if (!current) {
    current = systemIsDark ? "dark" : "light";
}

const apply = function () {
    html.classList.remove('dark', 'light');
    html.classList.add(current);
}

apply();

export const colorScheme = writable(current);

colorScheme.toggle = () => {
    current = current === "dark" ? "light" : "dark";
    colorScheme.set(current);
    localStorage.setItem("color-scheme", current);
    apply();
};
