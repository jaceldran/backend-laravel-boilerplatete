<script>
    import { inertia, page } from "@inertiajs/svelte";
    import { colorScheme } from "@/stores/colorScheme.js";
    import { jsonRender } from "@/utils.js";
    import Navigation from "@/components/ui/Navigation.svelte";
    import FlashMessage from "@/components/FlashMessage.svelte";
    import UserButton from "@/components/UserButton.svelte";
    import DarkModeButton from "@/components/DarkModeButton.svelte";
    import Logo from "@/layouts/bird-transparent.png";

    const user = $page.props.user;
    const mainNavigation = $page.props.mainNavigation;
    const headerButtonApply =
        "py-1 rounded-full bg-neutral-100 text-neutral-700 dark:bg-neutral-700 dark:text-neutral-300 w-12 inline-flex justify-center";
</script>

<div class="layout {$colorScheme}">
    <header class="bg-white dark:bg-neutral-950">
        <a use:inertia href="/" class="flex items-center justify-center ml-4">
            <img src={Logo} alt="log" class="h-16" />
        </a>
        <span class="flex items-center mr-4">
            <Navigation class="mr-4" routes={mainNavigation} />
            <DarkModeButton class={headerButtonApply} />
            <UserButton class={headerButtonApply} {user} />
        </span>
    </header>

    <main class="container mx-auto {$$props.class}">
        <FlashMessage />
        <slot />
    </main>

    <!-- <footer class="dark:bg-neutral-950">[FOOTER]</footer> -->
</div>

<style>
    .layout {
        @apply flex flex-col h-svh;
    }
    header {
        @apply flex justify-between items-center shadow-md w-full;
    }
    main {
        @apply flex-1;
    }
    .layout.dark img {
        @apply sepia;
    }
</style>
