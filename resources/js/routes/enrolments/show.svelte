<script>
    import Main from "@/layouts/App.svelte";
    import Breadcrumb from "@/components/ui/Breadcrumb.svelte";
    import ObjectRender from "@/components/ui/ObjectRender.svelte";

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

    <div class="py-4 text-xl font-medium">
        <div>name: {contactName()}</div>
        <div>email: {data.contact_email}</div>
        <div class="capitalize">product: {productName().toLowerCase()}</div>
    </div>

    <ObjectRender {data} />
</Main>
