<script>
    import { router, inertia } from "@inertiajs/svelte";
    import { formatDistanceToNow } from "date-fns";
    import { es } from "date-fns/locale";
    import ObjectRender from "@/components/ui/ObjectRender.svelte";
    import SearchInput from "@/components/ui/SearchInput.svelte";
    import ToolBar from "@/components/ui/ToolBar.svelte";
    import Navigation from "@/components/ui/Navigation.svelte";
    import Main from "@/layouts/App.svelte";
    import Icon from "@/components/ui/Icon.svelte";
    import {
        faArrowRight,
        faCirclePlay,
        faEye,
        faRefresh,
    } from "@fortawesome/free-solid-svg-icons";
    import { dateFormat, isDate, jsonRender } from "@/utils.js";
    import systemLinks from "@/routes/system/sections.js";

    export let configs;
    export let q;

    const routes = systemLinks.setActive("configs").asArray();

    const breadcrumbLinks = [
        { text: "Sistema", href: "/system" },
        { text: "Configs", href: "/system/configs" },
        // { text: `${model.name}`, href: "#" },
    ];
</script>

<Main {breadcrumbLinks}>
    <ToolBar class="justify-between">
        <Navigation class="horizontal subnav" {routes} />
        <SearchInput url="/system/configs" {q} />
    </ToolBar>

    <ObjectRender data={configs} />
</Main>
