<script>
    import Main from "@/layouts/App.svelte";
    import Breadcrumb from "@/components/ui/Breadcrumb.svelte";
    import { dateFormat, jsonRender, numberFormat } from "@/utils.js";

    export let enrolment;

    let data = { ...enrolment, ...enrolment.data };

    delete data.data;

    const links = [
        { text: "Enrolments", href: "/enrolment" },
        { text: `${enrolment.contact_email}`, href: "#" },
    ];

    function isDateValue(value) {
        let dt = new Date(value);

        return (
            Object.prototype.toString.call(dt) === "[object Date]" &&
            !isNaN(dt.getTime()) &&
            dt.getTime() > 1
        );
    }

    const renderValue = (value) => {
        let render;
        switch (typeof value) {
            case "object":
                render = jsonRender(value);
                break;
            default:
                if (isDateValue(value)) {
                    value = dateFormat(value, {
                        weekday: "long",
                        month: "short",
                        hour: "numeric",
                        minute: "numeric",
                    });
                }

                render = value;
        }

        return render;
    };

    const contactName = () => {
        if (data.hasOwnProperty("contact")) {
            return `${data.contact.firstname || "?"} ${
                data.contact.lastname || ""
            }`;
        }
    };

    const productName = () => {
        if (data.hasOwnProperty("product")) {
            return data.product.name;
        }
    };

    const refresh = () => {
        alert("Sincronizar Dynamics ");
    };
</script>

<Main>
    <Breadcrumb {links} />

    <div class="grid grid-cols-4">
        <div
            class="dark:bg-neon-dark-dark col-span-4 p-4 text-xl bg-neon-light-lighter"
        >
            <div>{contactName()}</div>
            <div>{data.contact_email}</div>
            <div class="capitalize">{productName().toLowerCase()}</div>
        </div>
        {#each Object.entries(data) as [key, value]}
            <div
                class="truncate p-2 border-b border-neon-light-lighter bg-neon-light-lightest dark:border-neon-light-darkest col-span-1 dark:bg-neon-dark-dark"
            >
                {key}
            </div>
            <div
                class="truncate p-2 border-b border-neon-light-lighter dark:border-neon-light-darkest col-span-3"
            >
                {#if typeof value === "object"}
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
    <!-- <pre>{jsonRender(payment)}</pre> -->
</Main>
