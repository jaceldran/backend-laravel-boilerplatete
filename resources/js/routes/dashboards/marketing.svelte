<script>
    import PieChart from "@/components/Highcharts/PieChart.svelte";
    import Breadcrumb from "@/components/ui/Breadcrumb.svelte";
    import Navigation from "@/components/ui/Navigation.svelte";
    import Main from "@/layouts/App.svelte";
    import Icon from "@/components/ui/Icon.svelte";
    import { faExpand } from "@fortawesome/free-solid-svg-icons";

    //export let sales;
    export let salesByProduct;
    export let salesByCategory;

    const links = [
        { text: "Dashboards", href: "/dashboards" },
        { text: "Marketing", href: "/dashboards/marketing" },
    ];

    const routes = [
        { text: "Marketing", href: "/dashboards/marketing", active: true },
        { text: "Académico", href: "/dashboards/marketing", active: false },
        { text: "Financiero", href: "/dashboards/marketing", active: false },
    ];
</script>

<Main>
    <Breadcrumb {links} class="py-2">
        <!-- <Icon icon={faExpand} /> -->
        <Navigation class="horizontal" {routes} />
    </Breadcrumb>

    <div
        class="flex items-center justify-center w-full outline outline-neutral-200 p-4"
    >
        <PieChart title="Ventas por producto" data={salesByProduct} />
        <PieChart title="Ventas por categoría" data={salesByCategory} />
    </div>

    <!-- <div class="table">
        <div class="th date">date</div>
        <div class="th customer">customer</div>
        <div class="th product">product</div>
        <div class="th category">category</div>
        <div class="th amount">amount</div>

        {#each sales.data as { date, customer, product, category, amount }}
            <div class="td date">
                {dateFormat(date, { month: "short" })}
            </div>
            <div class="td customer">{customer}</div>
            <div class="td product">{product}</div>
            <div class="td category">{category}</div>
            <div class="td amount">{moneyFormat(amount / 100)}</div>
        {/each}
    </div> -->

    <!-- <div class="pagination">
        <Pagination links={sales.links} />
    </div> -->

    <!-- <pre>{jsonRender(salesByCategory)}</pre> -->
</Main>

<!-- <style>
    .table {
        @apply grid grid-cols-6;
    }
    .th {
        @apply border-b p-3 font-normal;
    }
    .td {
        @apply border-b p-3;
    }
    .date {
        @apply col-span-1;
    }
    .customer {
        @apply col-span-2;
    }
    .product {
        @apply col-span-1;
    }
    .category {
        @apply col-span-1;
    }
    .amount {
        @apply col-span-1 text-right;
    }
    .pagination {
        @apply border-double border-b-4;
    }
</style> -->
