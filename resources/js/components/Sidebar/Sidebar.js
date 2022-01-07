import BurgerMenu from "../BurgerMenu/BurgerMenu.vue";
import {mapActions, mapGetters} from "vuex";

export default {
    name: "Sidebar",
    components: {BurgerMenu},
    data() {
      return {
          hiddenStyles: {
              marginLeft: '-190px'
          },
          showedStyles: {
              marginLeft: '0'
          },
          sidebarStyles: {},
          isOpen: true
      }
    },
    methods: {
        ...mapActions(['toggleSidebarAction']),
        redirectTo(path = '') {
            window.location = 'http://telegram-bot.manager/' + path;
        },
        toggleSidebar(payload) {
            this.isOpen = payload;
            this.toggleSidebarAction(this.isOpen);
            if (payload) {
                this.sidebarStyles = this.showedStyles;
            } else {
                this.sidebarStyles = this.hiddenStyles;
            }
        },
        created() {
            this.toggleSidebarAction(this.isOpen);
        }
    }
}
