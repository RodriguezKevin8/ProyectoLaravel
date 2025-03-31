import Chart from "chart.js/auto";

export default {
    mounted() {
        this.renderCharts();
    },

    methods: {
        renderCharts() {
            // Gráfico de barras - Participación por evento (CA-21)
            new Chart(document.getElementById("participacionEventoChart"), {
                type: "bar",
                data: {
                    labels: this.$el.dataset.eventos
                        ? JSON.parse(this.$el.dataset.eventos)
                        : [],
                    datasets: [
                        {
                            label: "Participantes",
                            data: this.$el.dataset.participantes
                                ? JSON.parse(this.$el.dataset.participantes)
                                : [],
                            backgroundColor: "rgba(54, 162, 235, 0.5)",
                            borderColor: "rgba(54, 162, 235, 1)",
                            borderWidth: 1,
                        },
                    ],
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });

            // Gráfico de pastel - Estado de eventos (CA-22)
            new Chart(document.getElementById("estadoEventosChart"), {
                type: "pie",
                data: {
                    labels: ["Activos", "Inactivos", "Finalizados"],
                    datasets: [
                        {
                            data: this.$el.dataset.estados
                                ? JSON.parse(this.$el.dataset.estados)
                                : [],
                            backgroundColor: [
                                "rgba(75, 192, 192, 0.5)",
                                "rgba(255, 206, 86, 0.5)",
                                "rgba(255, 99, 132, 0.5)",
                            ],
                            borderColor: [
                                "rgba(75, 192, 192, 1)",
                                "rgba(255, 206, 86, 1)",
                                "rgba(255, 99, 132, 1)",
                            ],
                            borderWidth: 1,
                        },
                    ],
                },
                options: {
                    responsive: true,
                },
            });

            // Otros gráficos similares para CA-23 y CA-24
        },
    },
};
