<script>
    import { inertia, page } from "@inertiajs/svelte";
    import FlashMessage from "@/components/FlashMessage.svelte";
    import UserButton from "@/components/UserButton.svelte";
    import Navigation from "@/components/Navigation.svelte";
    import DarkModeButton from "@/components/DarkModeButton.svelte";
    import Logo from "@/layouts/bird-transparent.png";

    const user = $page.props.user;
    const mainNavigation = $page.props.mainNavigation;
    const headerButtonApply =
        "py-1 rounded-full bg-neutral-100 text-neutral-700 dark:bg-neutral-700 dark:text-neutral-300 w-12 inline-flex justify-center";
</script>

<div class="layout">
    <header class="bg-white dark:bg-neutral-950">
        <a
            use:inertia
            href="/"
            class="flex items-center justify-center ml-4 dark:sepia"
        >
            <img src={Logo} alt="log" class="w-12 h-12" />
        </a>
        <span class="flex items-center mr-4">
            <Navigation class="mr-4" {user} routes={mainNavigation} />
            <DarkModeButton class={headerButtonApply} />
            <UserButton class={headerButtonApply} {user} />
        </span>
    </header>

    <main class={$$props.class}>
        <FlashMessage />
        <slot />
    </main>

    <footer class="dark:bg-neutral-950">[FOOTER]</footer>
</div>

<style>
    .layout {
        @apply flex flex-col h-svh;
    }
    header {
        @apply flex justify-between items-center shadow-md w-full;
    }
    footer {
        @apply p-4;
    }
    main {
        @apply flex-1;
    }
</style>
