<script>
    import Main from "@/layouts/App.svelte";
    import { inertia, page } from "@inertiajs/svelte";
    import { colorScheme } from "@/stores/colorScheme.js";
    import Breadcrumb from "@/components/ui/Breadcrumb.svelte";
    import Navigation from "@/components/ui/Navigation.svelte";
    import Icon from "@/components/ui/Icon.svelte";
    import { faArrowRight } from "@fortawesome/free-solid-svg-icons";

    const links = [{ text: "Dashboards", href: "/dashboards" }];

    const routes = [
        { text: "Marketing", href: "/dashboards/marketing", active: false },
        { text: "Académico", href: "/dashboards/marketing", active: false },
        { text: "Financiero", href: "/dashboards/marketing", active: false },
    ];
</script>

<Main>
    <Breadcrumb {links} class="py-2">
        <Navigation class="horizontal" {routes} />
    </Breadcrumb>

    <nav class={$colorScheme}>
        <a use:inertia href="/dashboards/marketing">
            <Icon class="-mt-1" icon={faArrowRight} />
            <span class=" font-semibold"> Marketing</span>
        </a>
        <a use:inertia href="/dashboards/marketing">
            <Icon class="-mt-1" icon={faArrowRight} />
            <span class=" font-semibold">Académico</span>
        </a>
        <a use:inertia href="/dashboards/marketing">
            <Icon class="-mt-1" icon={faArrowRight} />
            <span class=" font-semibold">Financiero</span>
        </a>
    </nav>
</Main>

<style>
    /* nav {
        @apply rounded shadow-sm mt-4 bg-neutral-100;
    } */
    a {
        @apply flex items-center gap-3 p-4;
    }
    a:hover {
        @apply bg-neon-light-lightest;
    }

    /* nav.dark a:hover {
        @apply bg-neutral-700;
    } */
</style>
