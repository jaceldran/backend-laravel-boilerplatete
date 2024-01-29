<script>
    import { onMount } from "svelte";
    import PieChart from "@/components/Highcharts/PieChart.svelte";
    // import Highcharts from "highcharts";
    import Main from "@/layouts/App.svelte";
    import Pagination from "@/components/Pagination.svelte";
    import { dateFormat, jsonRender, moneyFormat } from "@/utils.js";

    export let sales;
    export let salesByProduct;
    export let salesByCategory;
</script>

<Main>
    <div class="grid grid-cols-2">
        <div class="">
            <PieChart
                title="Ventas por producto"
                data={salesByProduct}
                apply="h-76"
            />
        </div>
        <div class="">
            <PieChart
                title="Ventas por categoría"
                data={salesByCategory}
                apply="h-76"
            />
        </div>
    </div>

    <div class="table">
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
    </div>

    <div class="pagination">
        <Pagination links={sales.links} />
    </div>

    <!-- <pre>{jsonRender(salesByCategory)}</pre> -->
</Main>

<style>
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
</style>
