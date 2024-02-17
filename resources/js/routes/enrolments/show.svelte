<script>
    import Main from "@/layouts/App.svelte";
    import Breadcrumb from "@/components/ui/Breadcrumb.svelte";
    import ObjectRender from "@/components/ui/ObjectRender.svelte";
    import { jsonRender } from "@/utils";

    export let enrolment;

    let data = { ...enrolment, ...enrolment.data };

    delete data.data;

    const links = [
        { text: "Enrolments", href: "/enrolment" },
        { text: `${enrolment.contact_email}`, href: "#" },
    ];

    const contactName = () => {
        if (data.hasOwnProperty("contact")) {
            return `${data.contact.firstname || "?"} ${
                data.contact.lastname || ""
            }`;
        }

        return "?";
    };

    const productName = () => {
        if (data.hasOwnProperty("product")) {
            return data.product.name;
        }

        return "?";
    };

    const refresh = () => {
        alert("Sincronizar Dynamics ");
    };
</script>

<Main>
    <Breadcrumb {links} />

    <div class="text-lg bg-neon-50 rounded my-4 p-2">
        <div>{contactName()}</div>
        <div>{data.contact_email}</div>
        <div class="capitalize">
            {productName().toLowerCase()}
        </div>
    </div>

    <ObjectRender {data} />
</Main>
