<script>
    import { isValid, parseISO } from "date-fns";
    import { dateFormat, jsonRender, numberFormat } from "@/utils.js";

    export let data;

    const renderValue = (value) => {
        let render;
        switch (typeof value) {
            case "object":
                render = jsonRender(value);
                break;
            default:
                // if (isValid(parseISO(value))) {
                //     value = dateFormat(value, {
                //         weekday: "long",
                //         month: "short",
                //         hour: "numeric",
                //         minute: "numeric",
                //     });
                // }

                render = value;
        }

        return render;
    };

    function isDateValue(value) {
        // let dt = new Date(value);
        // return (
        //     Object.prototype.toString.call(dt) === "[object Date]" &&
        //     !isNaN(dt.getTime()) &&
        //     dt.getTime() > 1
        // );
    }
</script>

<div class="grid grid-cols-4 w-full">
    {#each Object.entries(data) as [key, value]}
        <div
            class="truncate p-2 border-b bg-normal dark:bg-dark dark:border-dark col-span-1"
        >
            {key}
        </div>
        <div
            class="whitespace-break-spaces break-words p-2 border-b col-span-3 dark:border-dark"
        >
            {#if value && typeof value === "object"}
                <div class="grid grid-cols-4">
                    {#each Object.entries(value) as [k, v]}
                        <div
                            class="truncate p-2 border-b bg-normal dark:bg-dark dark:border-dark col-span-1"
                        >
                            {k}
                        </div>

                        <div
                            class="whitespace-break-spaces p-2 border-b col-span-3 dark:border-dark"
                        >
                            {renderValue(v)}
                        </div>
                    {/each}
                </div>
            {:else}
                {renderValue(value)}
            {/if}
        </div>
    {/each}
</div>
