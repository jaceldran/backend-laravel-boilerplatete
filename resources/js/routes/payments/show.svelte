<script>
    import Main from "@/layouts/App.svelte";
    import Breadcrumb from "@/components/ui/Breadcrumb.svelte";
    import { dateFormat, jsonRender, numberFormat } from "@/utils.js";

    export let payment;

    let data = { ...payment, ...payment.data };

    delete data.data;

    const links = [
        { text: "Payments", href: "/payments" },
        { text: `${payment.reference} (${payment.source_type})`, href: "#" },
    ];

    const renderValue = (value) => {
        let render;
        switch (typeof value) {
            case "object":
                render = jsonRender(value);
                break;
            default:
                render = value;
        }
        return render;
    };

    const refresh = () => {
        alert("Sincronizar Dynamics ");
    };
</script>

<Main>
    <Breadcrumb {links} />
    <div class="grid grid-cols-4">
        {#each Object.entries(data) as [key, value]}
            <div
                class="truncate p-2 border-b border-neon-light-lighter bg-neon-light-lightest dark:border-neon-light-darker col-span-1 dark:bg-neon-dark-dark"
            >
                {key}
            </div>
            <div
                class="truncate p-2 border-b border-neon-light-lighter dark:border-neon-ligstt-darker col-span-3"
            >
                {renderValue(value)}
            </div>
        {/each}
    </div>
    <!-- <pre>{jsonRender(payment)}</pre> -->
</Main>
