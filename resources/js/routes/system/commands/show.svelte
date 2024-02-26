<script>
    import { router, inertia } from "@inertiajs/svelte";
    import { formatDistanceToNow } from "date-fns";
    import { es } from "date-fns/locale";
    import Breadcrumb from "@/components/ui/Breadcrumb.svelte";
    import ObjectRender from "@/components/ui/ObjectRender.svelte";
    import ToolBar from "@/components/ui/ToolBar.svelte";
    import Navigation from "@/components/ui/Navigation.svelte";
    import SearchInput from "@/components/ui/SearchInput.svelte";
    import Main from "@/layouts/App.svelte";
    import Icon from "@/components/ui/Icon.svelte";
    import {
        faArrowRight,
        faCircleRight,
        faEye,
        faRefresh,
    } from "@fortawesome/free-solid-svg-icons";
    import { dateFormat, isDate, jsonRender } from "@/utils.js";

    export let command;
</script>

<Main>
    <ObjectRender data={command} />
</Main>
