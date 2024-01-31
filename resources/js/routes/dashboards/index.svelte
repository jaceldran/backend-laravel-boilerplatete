<script>
    import Main from "@/layouts/App.svelte";
    import { inertia, page } from "@inertiajs/svelte";
    import { jsonRender } from "@/utils.js";
</script>

<Main class="h-screen flex flex-col items-center justify-center font-medium">
    <nav>
        <a use:inertia href="/dashboards/marketing"> Marketing </a>
    </nav>
</Main>
