export default {
    name: "BurgerMenu",
    props: {
        defaultOpen: {
            type: Boolean,
            default: true
        }
    },
    data() {
        return {
            isOpen: true,
            leftElemStylesOpen: {
                transform: 'rotate(45deg)',
                position: 'absolute'
            },
            rightElemStylesOpen: {
                transform: 'rotate(135deg)',
                position: 'absolute'
            },
            leftElemStylesClosed: {

            },
            rightElemStylesClosed: {

            },
            positionLeft: {},
            positionRight: {}
        }
    },
    methods: {
        update() {
            this.isOpen = !this.isOpen;
            this.sync();
        },
        sync() {
            if (!this.isOpen) {
                this.positionLeft = this.leftElemStylesClosed;
                this.positionRight = this.rightElemStylesClosed;
            } else {
                this.positionLeft = this.leftElemStylesOpen;
                this.positionRight = this.rightElemStylesOpen;
            }
        },
        clickToMenu(e) {
            this.update();
            this.$emit('onClickEvt', this.isOpen);
        }
    },
    created() {
        this.isOpen = this.defaultOpen;
        this.sync();
    }
}
