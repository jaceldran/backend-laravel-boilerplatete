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
</script>

<div class="layout {$colorScheme}">
    <header class="bg-white dark:bg-neon-900">
        <a
            use:inertia
            href="/"
            class="flex items-center justify-center px-6 py-2"
        >
            <img src={Logo} alt="log" class="h-12" />
        </a>
        <span class="flex items-center mr-4">
            <Navigation
                class="mr-4"
                routes={mainNavigation}
                linkDefault="text-neon-500 font-medium dark:text-neon-200"
                linkActive="bg-neon-50 dark:bg-neon-600"
            />
            <DarkModeButton class="" />
            <UserButton class="" {user} />
        </span>
    </header>

    <main class="container mx-auto pb-8 {$$props.class}">
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
