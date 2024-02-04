<script>
    import { router, inertia } from "@inertiajs/svelte";
    import Breadcrumb from "@/components/ui/Breadcrumb.svelte";
    import SearchInput from "@/components/ui/SearchInput.svelte";
    import TableContent from "@/components/ui/TableContent.svelte";
    import TableHeader from "@/components/ui/TableHeader.svelte";
    import TableBody from "@/components/ui/TableBody.svelte";
    import TableRow from "@/components/ui/TableRow.svelte";
    import TableTd from "@/components/ui/TableTd.svelte";
    import TableTh from "@/components/ui/TableTh.svelte";
    import MainContent from "@/layouts/App.svelte";
    import Pagination from "@/components/ui/Pagination.svelte";
    import { dateFormat, jsonRender, numberFormat } from "@/utils.js";

    export let payments;

    const links = [{ text: "Payments", href: "#" }];
</script>

<MainContent>
    <Breadcrumb {links}>
        <SearchInput url="/payments" />
    </Breadcrumb>

    <TableContent>
        <TableHeader>
            <TableRow>
                <TableTh>created_at</TableTh>
                <TableTh>source</TableTh>
                <TableTh>reference</TableTh>
                <TableTh>method</TableTh>
                <TableTh class="attempts">attempts</TableTh>
                <TableTh>result</TableTh>
                <TableTh class="amount">amount</TableTh>
            </TableRow>
        </TableHeader>
        <TableBody>
            {#each payments.data as { id, source_type, source_name, source_id, reference, method, amount, result, attempts, data, created_at }}
                <TableRow class="border-b border-t">
                    <TableTd class="created_at"
                        >{dateFormat(created_at, {
                            hour: "numeric",
                            minute: "numeric",
                        })}</TableTd
                    >
                    <TableTd>{source_type}</TableTd>
                    <TableTd>
                        <a
                            class="truncate inline-block max-w-30"
                            use:inertia
                            href="/payments/{id}">{reference}</a
                        >
                    </TableTd>
                    <TableTd class="method">{method}</TableTd>
                    <TableTd class="attempts">{attempts}</TableTd>
                    <TableTd class="result">{result}</TableTd>
                    <TableTd class="amount">
                        {numberFormat(amount, { currency: "EUR" })}
                    </TableTd>
                </TableRow>
            {/each}
        </TableBody>
    </TableContent>

    <Pagination data={payments} />
</MainContent>
