/**
 * **AlertBox**
 * 
 * Class to create popup boxes
 * @author JuanGV
 * @version 1.0.0
 * @name AlertBox
 * @license MIT
 */
class AlertBox {

    /**
     * Initial content, empty if the user does not specify
     * anything in the constructor dictionary
     * @private
     * @type {string}
     */
    #initialContent;

    /**
     * **Constructor**
     * 
     * Create an object for alert boxes. Per parameter you will receive a list of
     * the type dictionary with box settings. These data can be changed
     * @param {array} data List with configuration data
     * @constructor
     */
    constructor(data){
        //Capture the general container, box, close icon, title and content
        this.alertContainer = document.createElement("div");
        this.alertBox       = document.createElement("div");
        this.alertClose     = document.createElement("span");
        this.titleElement   = document.createElement("h1");
        this.alertContent   = document.createElement("div");

        //Callback methods
        this.onClose = data.onClose;

        //When the close icon is clicked, the window is closed
        this.alertClose.addEventListener("click", () => this.close());







        //Establece los segundos de la animación y la ubicación
        this.alertContainer.style.transition = data.transition ?? "0";
        this.alertContainer.style.zIndex = "999";

        
        this.title = data.title ?? "";


        /*let TopScroll = window.pageYOffset || document.documentElement.scrollTop;
        let LeftScroll = window.pageXOffset || document.documentElement.scrollLeft;
        
        window.addEventListener("scroll", function(e){
            window.scrollTo(LeftScroll, TopScroll);
        });*/

        this.#initialContent = data.content ?? "";
        this.removeOnClose = data.content != false ? true : false;

        //Set the class name of the elements
        this.alertContainer.className = "centered-container alert-container";
        this.alertBox.className = "center-box";
        this.alertClose.className = "alert-close";
        this.alertContent.style.height = "100%";

        //Alert box size
        this.alertBox.style.width = data.width ?? "20%";
        if(data.height) this.alertBox.style.height = data.height;

        //Datos del título
        

        this.alertBox.append(this.titleElement);
        this.alertClose.innerHTML = "&times;";
        this.alertContent.innerHTML = this.#initialContent;

        this.alertBox.append(this.alertClose);
        this.alertBox.append(this.alertContent);
        this.alertContainer.append(this.alertBox);

        this.alertContainer.addEventListener("transitionend", () => {
            if(this.alertContainer.style.opacity == "0"){
                this.alertContainer.style.zIndex = -1;
                this.content = this.#initialContent;

                if(this.removeOnClose) this.alertContainer.remove();
            }

            

            //document.body.style.overflow = "visible";
            //this.alertContainer.remove();
            //this.onClose();
        });
    }

    show(){
        console.log(this.alertContainer);
        this.alertContainer.style.zIndex = 999;
        //document.body.style.overflow = "hidden";
        this.alertContainer.style.opacity = 0;
        document.body.append(this.alertContainer);
        window.setTimeout(() => {
            this.alertContainer.style.opacity = 1;
        }, 0);
    }

    /**
     * **Close the window**
     * 
     * Método para cerrar la ventana abierta. Si el trigger de
     * eliminación está activo, luego no se puede volver a mostrar
     * @returns {void}
     * @function
     * @public
     */
    close(){
        //Set the opacity of the overall container to 0
        this.alertContainer.style.opacity = 0;
    }




    get title(){
        return this.titleElement.innerText;
    }

    get content(){
        return this.alertContent.innerHTML;
    }


    /**
     * **Change title**
     * 
     * Method to change the title of the window
     * @param {string} newTitle New title
     */
    set title(newTitle){
        //Sets the content of the title
        this.titleElement.innerText = newTitle;
    }

    /**
     * **Change content**
     * 
     * Method to change the content of the window
     * @param {string} newContent New content
     */
    set content(newContent){
        //Sets a new content for the window
        this.alertContent.innerHTML = newContent;
    }
}