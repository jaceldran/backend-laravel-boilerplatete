<script>
    import { router, inertia } from "@inertiajs/svelte";
    import { formatDistanceToNow } from "date-fns";
    import { es } from "date-fns/locale";
    import Breadcrumb from "@/components/ui/Breadcrumb.svelte";
    import ObjectRender from "@/components/ui/ObjectRender.svelte";
    import ToolBar from "@/components/ui/ToolBar.svelte";
    import Navigation from "@/components/ui/Navigation.svelte";
    import SearchInput from "@/components/ui/SearchInput.svelte";
    import TableContent from "@/components/ui/TableContent.svelte";
    import TableHeader from "@/components/ui/TableHeader.svelte";
    import TableBody from "@/components/ui/TableBody.svelte";
    import TableRow from "@/components/ui/TableRow.svelte";
    import TableTh from "@/components/ui/TableTh.svelte";
    import TableTd from "@/components/ui/TableTd.svelte";
    import Main from "@/layouts/App.svelte";
    import Pagination from "@/components/ui/Pagination.svelte";
    import Icon from "@/components/ui/Icon.svelte";
    import {
        faFileLines,
        faEye,
        faRefresh,
    } from "@fortawesome/free-solid-svg-icons";
    import { dateFormat, isDate, jsonRender } from "@/utils.js";
    import systemLinks from "@/routes/system/sections.js";

    export let models;
    export let q;

    const routes = systemLinks.setActive("models").asArray();

    // por alguna razón es más rápido abrir con location.href
    // que usando intertia, al parecer debido al tiempo que
    // consume el componente ObjectRender cuando el json es
    // bastante extenso.
    const show = (id) => {
        // router.get(`/system-models/${id}`);
        location.href = `/system/models/${id}`;
    };
    const breadcrumbLinks = [
        { text: "Sistema", href: "/system" },
        { text: "Modelos", href: "/system/models" },
    ];
</script>

<Main {breadcrumbLinks}>
    <ToolBar class="justify-between">
        <Navigation class="horizontal subnav" {routes} />
        <section class="flex gap-2">
            <button>
                <Icon icon={faRefresh} class="" />
            </button>
            <SearchInput url="/system/models" {q} />
        </section>
    </ToolBar>

    <TableContent>
        <TableHeader>
            <TableRow>
                <TableTh>Tipo</TableTh>
                <TableTh>Modelo</TableTh>
                <TableTh class="text-right">Atributos</TableTh>
                <TableTh></TableTh>
            </TableRow>
        </TableHeader>

        <TableBody>
            {#each models.data as { id, type, name, data }}
                <!-- <TableRow on:click={show(id)} data-id={id}> -->
                <TableRow>
                    <TableTd class="wmin">{type}</TableTd>
                    <TableTd class="">{name}</TableTd>
                    <TableTd class="text-right">
                        {Object.entries(data).length}
                    </TableTd>
                    <TableTd class="wmin !p-0">
                        <button
                            class="cursor-pointer py-2 px-4"
                            on:click={show(id)}
                            data-id={id}
                        >
                            <Icon icon={faEye} size="lg" />
                        </button>
                    </TableTd>
                </TableRow>
            {/each}
        </TableBody>
    </TableContent>

    <Pagination data={models} />
</Main>
