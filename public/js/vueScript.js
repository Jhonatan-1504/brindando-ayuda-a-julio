const app = new Vue({
  el: "#templateVue",
  data: {
    url: "http://localhost/colegio-ejemplo/api/aulas",
    titleHeaderTable: ["#", "aula", "seccion", "options"],
    allAulas: [],
    filterAulas: [],
    message: "",
    class: "success",
    searchInput: "",
    id: "",
    aula: "",
    seccion: "",
  },
  methods: {
    async getAll() {
      const { data } = await axios(this.url);
      this.allAulas = data;
      this.filterAulas = data;
    },
    async createAula() {
      const { data } = await axios.post(`${this.url}/Crear`, {
        aula: this.aula,
        seccion: this.seccion,
      });
      this.message = data[0].msg;
      this.class = "success";
      this.getAll();
    },
    async editAula() {
      const { data } = await axios.put(`${this.url}/Actualizar/${this.id}`, {
        aula: this.aula,
        seccion: this.seccion,
      });
      this.message = data[0].msg;
      this.class = "success";
      this.getAll();
    },
    async deleteAula(id) {
      const { data } = await axios.delete(`${this.url}/Borrar/${id}`);
      this.message = data[0].msg;
      this.class = "success";
      this.getAll();
      setTimeout(() => (this.message = ""), 1000);
    },
    clean() {
      this.id = "";
      this.aula = "";
      this.seccion = "";
    },
    selecionAction() {
      if (!this.aula && !this.seccion) {
        this.message = "Llena los campos";
        this.class = "danger";
        setTimeout(() => (this.message = ""), 1000);
        return;
      }
      if (this.id) {
        this.editAula();
      } else {
        this.createAula();
      }
      this.clean();
      setTimeout(() => (this.message = ""), 1000);
    },
    rellenarForm(aula) {
      this.id = aula.id;
      this.aula = aula.aula;
      this.seccion = aula.seccion;
    },
  },
  computed: {
    classAlert() {
      return `alert alert-${this.class} alert-dismissible fade show py-4`;
    },
    idClass() {
      if (!this.id) return "btn btn-primary";
      return "btn btn-warning";
    },
  },
  mounted() {
    this.getAll();
  },
});