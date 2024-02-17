<script>
    import { router, inertia } from "@inertiajs/svelte";
    import ToolBar from "@/components/ui/ToolBar.svelte";
    import SearchInput from "@/components/ui/SearchInput.svelte";
    import TableContent from "@/components/ui/TableContent.svelte";
    import TableHeader from "@/components/ui/TableHeader.svelte";
    import TableBody from "@/components/ui/TableBody.svelte";
    import TableRow from "@/components/ui/TableRow.svelte";
    import TableTd from "@/components/ui/TableTd.svelte";
    import TableTh from "@/components/ui/TableTh.svelte";
    import MainContent from "@/layouts/App.svelte";
    import Pagination from "@/components/ui/Pagination.svelte";
    import Icon from "@/components/ui/Icon.svelte";
    import { faEye } from "@fortawesome/free-solid-svg-icons";
    import { dateFormat, jsonRender, numberFormat } from "@/utils.js";
    import { formatDistanceToNow } from "date-fns";
    import { es } from "date-fns/locale";

    export let payments;

    const paymentStatusColor = (source_type, method, attempts, result) => {
        let color = "bg-[silver] dark:bg-white";

        const isTpv = method === "tpv_card" || method === "bizum";
        const IsUnknown =
            method === "transfer" ||
            method === "flywire" ||
            source_type === "live";

        if ((isTpv && result !== "ok") || result === "ko") {
            color = "bg-[lightblue] dark:bg-[deepskyblue]";
            color = "bg-[indianred] dark:bg-[red]";
        }

        // if (isTpv && attempts > 1) {
        // }

        if (IsUnknown) {
            color = "bg-[gold] dark:bg-[gold]";
        }

        if (result === "ok") {
            color = "bg-[lightgreen] dark:bg-[greenyellow]";
        }

        return color;
    };
</script>

<MainContent>
    <ToolBar class="justify-between">
        <div>
            <button class="action">Action 1</button>
            <button class="action">Action 2</button>
            <button class="action">Action 3</button>
        </div>
        <SearchInput url="/payments" />
    </ToolBar>

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
                <TableTh class="actions"></TableTh>
            </TableRow>
        </TableHeader>
        <TableBody>
            {#each payments.data as { id, source_type, source_name, source_id, reference, method, amount, result, attempts, data, created_at }}
                <TableRow class="border-b border-t">
                    <TableTd class="created_at whitespace-nowrap">
                        <span
                            class="inline-block h-3 w-3 rounded-full {paymentStatusColor(
                                source_type,
                                method,
                                attempts,
                                result,
                            )}"
                        ></span>

                        <span>
                            {dateFormat(created_at, {
                                hour: "numeric",
                                minute: "numeric",
                            })}

                            <div class="text-sm ml-4">
                                hace {formatDistanceToNow(created_at, {
                                    locale: es,
                                })}
                            </div>
                        </span>
                    </TableTd>
                    <TableTd>{source_type}</TableTd>
                    <TableTd>
                        {reference}
                        <div class="text-sm">
                            {data.charge_preinscripcion_numero || ""}
                            {data.charge_preinscripcion_nombre || ""}
                            {data.charge_preinscripcion_apellidos || ""}
                            {data.charge_preinscripcion_edicion_id || ""}
                        </div>
                    </TableTd>
                    <TableTd class="method">{method}</TableTd>
                    <TableTd class="attempts">{attempts}</TableTd>
                    <TableTd class="result">{result}</TableTd>
                    <TableTd class="amount">
                        {numberFormat(amount, { currency: "EUR" })}
                    </TableTd>
                    <TableTd class="actions align-middle p-0">
                        <a use:inertia href="/payments/{id}">
                            <Icon icon={faEye} size="lg" />
                        </a>
                    </TableTd>
                </TableRow>
            {/each}
        </TableBody>
    </TableContent>

    <Pagination data={payments} />

    <!-- <pre>{jsonRender(payments)}</pre> -->
</MainContent>
