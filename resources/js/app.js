import "./bootstrap";
import Swal from "sweetalert2";
// import "../node_modules/signature_pad/dist";
import SignaturePad from "signature_pad";

window.Swal = Swal;

document.addEventListener("alpine:init", () => {
    Alpine.data("signaturePad", (value) => ({
        signaturePadInstance: null,
        value: value,
        init() {
            this.signaturePadInstance = new SignaturePad(
                this.$refs.signature_canvas
            );
            this.signaturePadInstance.addEventListener("endStroke", () => {
                this.value = this.signaturePadInstance.toDataURL("image/png");
            });
        },
        clear() {
            this.signaturePadInstance.clear(); // clear the signature pad
            this.value = null;
        },
    }));
});
