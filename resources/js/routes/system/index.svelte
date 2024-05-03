<script>
    import { inertia, page } from "@inertiajs/svelte";
    import Main from "@/layouts/App.svelte";
    import systemLinks from "@/routes/system/sections.js";
    import Icon from "@/components/ui/Icon.svelte";
    import { faArrowRight } from "@fortawesome/free-solid-svg-icons";
    import { jsonRender } from "@/utils";

    const breadcrumbLinks = [{ text: "Sistema", href: "/system" }];
</script>

<Main {breadcrumbLinks}>
    <h1 class="text-hero">Sistema</h1>

    <p class="text-xl my-4">Características del sistema.</p>

    <nav class="grid grid-cols-1 md:grid-cols-2 gap-8">
        {#each systemLinks.asArray() as value}
            <a
                use:inertia
                href={value.href}
                class="block rounded-lg shadow-lg p-4 bg-light dark:bg-dark"
            >
                <div class="underlined-4 font-medium">{value.text}</div>
                <div class="mt-4">{value.description}</div>
            </a>
        {/each}
    </nav>
</Main>
