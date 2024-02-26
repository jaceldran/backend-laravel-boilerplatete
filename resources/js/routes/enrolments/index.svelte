<script>
    import { router, inertia } from "@inertiajs/svelte";
    import { formatDistanceToNow } from "date-fns";
    import { es } from "date-fns/locale";
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

    import { dateFormat, isDate } from "@/utils.js";

    export let enrolments;
    export let q;

    const productName = (data) => {
        if (data.hasOwnProperty("product")) {
            return data.product.name;
        }

        return data.request.product_id;
    };

    const contactName = (data) => {
        if (data.hasOwnProperty("contact")) {
            return `${data.contact.firstname || "?"} ${
                data.contact.lastname || ""
            }`;
        }
    };

    const openRegistration = (data, token) => {
        const url = `${data.request.url_registration}?token=${token}`;

        window.open(url);
    };

    const enrolmentStatusColor = (sync, sync_at, sync_attempts) => {
        let color = "bg-[silver] dark:bg-white";

        if (sync) {
            color = "bg-[lightblue] dark:bg-[deepskyblue]";
        }

        if (sync && sync_attempts > 1) {
            color = "bg-[indianred] dark:bg-[red]";
        }

        if (isDate(sync_at)) {
            color = "bg-[lightgreen] dark:bg-[greenyellow]";
        }

        return color;
    };

    const routes = [
        { text: "Enrolments", href: "/enrolments", active: true },
        {
            text: "Notifications",
            href: "/enrolments/notifications",
            active: false,
        },
    ];
    const breadcrumbLinks = [{ text: "Enrolments", href: "/enrolments" }];
</script>

<Main {breadcrumbLinks}>
    <ToolBar class="justify-between">
        <Navigation class="horizontal subnav" {routes} />
        <section class="flex gap-2">
            <button class="rounded-full bg-neon-100 px-4">
                <Icon icon={faRefresh} class="" />
            </button>
            <SearchInput url="/enrolments" {q} />
        </section>
    </ToolBar>

    <TableContent>
        <TableHeader>
            <TableRow>
                <TableTh>Entrada</TableTh>
                <TableTh>Solicitante</TableTh>
                <TableTh>Programa</TableTh>
                <TableTh>Sincronización</TableTh>
                <TableTh></TableTh>
            </TableRow>
        </TableHeader>

        <TableBody>
            {#each enrolments.data as { id, created_at, contact_email, token, sync, requests, sync_at, sync_attempts, data }}
                <TableRow>
                    <TableTd class="created_at whitespace-nowrap">
                        <span
                            class="inline-block h-3 w-3 rounded-full {enrolmentStatusColor(
                                sync,
                                sync_at,
                                sync_attempts,
                            )}"
                        ></span>

                        <span class="">
                            {dateFormat(created_at, {
                                weekday: "short",
                                hour: "numeric",
                                minute: "numeric",
                            })}

                            <div class="text-sm ml-4">
                                hace {formatDistanceToNow(created_at, {
                                    locale: es,
                                })}

                                - {data.request.lang || "es"}
                            </div>
                        </span>
                    </TableTd>

                    <TableTd class="contact_email">
                        {contact_email}
                        <div class="text-sm">{contactName(data)}</div>
                    </TableTd>

                    <TableTd class="product">{productName(data)}</TableTd>

                    <TableTd class="sync_at whitespace-nowrap">
                        <span
                            >{sync_at
                                ? dateFormat(sync_at, {
                                      //   weekday: "short",
                                      hour: "numeric",
                                      minute: "numeric",
                                  })
                                : "-"}
                        </span>

                        <div class="text-sm">
                            intentos: <span
                                class=" px-1 rounded-full {sync_attempts < 5
                                    ? ''
                                    : 'bg-[indianred]  text-white'}"
                                >{sync_attempts}</span
                            >
                        </div>
                    </TableTd>

                    <TableTd class="actions flex justify-end items-center">
                        <a
                            class="py-3 px-2"
                            use:inertia
                            href="/enrolments/{id}"
                        >
                            <Icon icon={faEye} size="lg" />
                        </a>
                        <button
                            title={data.request.url_registration}
                            class="py-3 px-2"
                            use:inertia
                            on:click={openRegistration(data, token)}
                        >
                            <Icon icon={faFileLines} size="lg" />
                        </button>
                    </TableTd>
                </TableRow>
            {/each}
        </TableBody>
    </TableContent>

    <Pagination data={enrolments} />
</Main>
