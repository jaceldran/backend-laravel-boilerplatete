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
            class="truncate p-2 border-b border-neon-light-lighter bg-neon-light-lightest dark:border-neon-light-darkest col-span-1 dark:bg-neon-dark-dark"
        >
            {key}
        </div>
        <div
            class="truncate p-2 border-b border-neon-light-lighter dark:border-neon-light-darkest col-span-3"
        >
            {#if value && typeof value === "object"}
                <div class="grid grid-cols-4">
                    {#each Object.entries(value) as [k, v]}
                        <div
                            class="truncate p-2 border-b border-neon-light-lighter bg-neon-light-lightest dark:border-neon-light-darker col-span-1 dark:bg-neon-dark-dark"
                        >
                            {k}
                        </div>

                        <div
                            class="truncate p-2 border-b border-neon-light-lighter dark:border-neon-ligstt-darker col-span-3"
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
