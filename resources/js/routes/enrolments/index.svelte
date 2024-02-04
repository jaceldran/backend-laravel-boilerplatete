<script>
    import { router, inertia } from "@inertiajs/svelte";
    import Breadcrumb from "@/components/ui/Breadcrumb.svelte";
    import SearchInput from "@/components/ui/SearchInput.svelte";
    import TableContent from "@/components/ui/TableContent.svelte";
    import TableHeader from "@/components/ui/TableHeader.svelte";
    import TableBody from "@/components/ui/TableBody.svelte";
    import TableRow from "@/components/ui/TableRow.svelte";
    import TableTh from "@/components/ui/TableTh.svelte";
    import TableTd from "@/components/ui/TableTd.svelte";
    import Main from "@/layouts/App.svelte";
    import Pagination from "@/components/ui/Pagination.svelte";
    import { dateFormat, jsonRender, numberFormat } from "@/utils.js";

    export let enrolments;

    const links = [{ text: "Enrolments", href: "#" }];

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

    const urlRegistration = (data, token) => {
        return `${data.request.url_registration}?token=${token}`;
    };
</script>

<Main>
    <Breadcrumb {links}>
        <SearchInput url="/enrolments" />
    </Breadcrumb>

    <TableContent>
        <TableHeader>
            <TableRow>
                <TableTh>created_at</TableTh>
                <TableTh>contact_email</TableTh>
                <TableTh>contact_name</TableTh>
                <TableTh>product</TableTh>
                <TableTh>sync_at</TableTh>
                <TableTh></TableTh>
            </TableRow>
        </TableHeader>

        <TableBody>
            {#each enrolments.data as { id, created_at, contact_email, token, sync, requests, sync_at, sync_attempts, data }}
                <TableRow>
                    <TableTd class="created_at"
                        >{dateFormat(created_at, {
                            hour: "numeric",
                            minute: "numeric",
                        })}</TableTd
                    >
                    <TableTd class="contact_email"
                        ><a use:inertia href="/enrolments/{id}"
                            >{contact_email} - {data.request.lang || "es"}</a
                        ></TableTd
                    >
                    <TableTd>{contactName(data)}</TableTd>
                    <TableTd class="product">{productName(data)}</TableTd>
                    <TableTd class="sync_at"
                        >{sync_at
                            ? dateFormat(sync_at, {
                                  //   weekday: "short",
                                  hour: "numeric",
                                  minute: "numeric",
                              })
                            : "-"}</TableTd
                    >
                    <TableTd class="actions">
                        <a
                            title={data.request.url_registration}
                            use:inertia
                            href={urlRegistration(data, token)}
                        >
                            enrolment
                        </a>
                    </TableTd>
                </TableRow>
            {/each}
        </TableBody>
    </TableContent>

    <Pagination data={enrolments} />
</Main>

<style>
    table {
        @apply w-full text-left;
    }
    th {
        @apply py-1 px-3 font-medium;
    }
    td {
        @apply py-3 px-3;
    }
    a {
        @apply underline;
    }
</style>
