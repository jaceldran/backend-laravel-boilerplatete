class Sections {
    constructor() {
        this.links = {
            configs: {
                href: "/system/configs",
                text: "Configuración",
                description: "Archivos de configuración de la aplicación.",
                active: false,
            },
            models: {
                href: "/system/models",
                text: "Modelos",
                description: "Configuraciones de los modelos de datos utilizados.",
                active: false,
            },
            commands: {
                href: "/system/commands",
                text: "Comandos",
                description:
                    "Ejecutar comandos sistema y revisar los logs de última ejecución",
                active: false,
            },
            routes: {
                href: "/request-docs",
                text: "Rutas",
                description: "Configuración de rutas disponibles de web y api.",
                active: false,
            },
        }
    }

    setActive(linkId) {
        for (let key in this.links) {
            this.links[key].active = false;
        }

        this.links[linkId].active = true;
        return this;
    }

    asArray() {
        return Object.values(this.links);
    }
}

export default new Sections();
