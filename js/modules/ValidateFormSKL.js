/**
 * IMPORTANTE: no suelta mensajes al usuario, permite evitar envíos
 * en caso de que el usuario haga un cambio en el HTML
 */
class ValidateFormSKL {

    #form;
    #formElements;
    #callbackOnError;

    constructor(form, callbackOnError){
        this.#form = form;
        this.#setValidator();
        this.#callbackOnError = callbackOnError;
    }

    #setValidator(){
        //Guarda los valores iniciales, realizando una copia para evitar cambios
        this.#formElements = this.#mapHTMLElements(this.#form.elements);
        
        //Añade un listener al formulario cuando se envíen los datos
        this.#form.addEventListener("submit", (e) => {
            //Evitar por defecto el envío
            e.preventDefault();

            let elements = this.#mapHTMLElements(this.#form.elements);


            let isValid = true;

            for(let j=0; j<elements.length; j++){
                //Obtener el grupo de claves de un elemento en concreto
                let keys1 = Object.keys(elements[j]);
                let keys2 = Object.keys(this.#formElements[j]);

                //Si la cantidad de claves es diferente, genera un error
                if(keys1.length != keys2.length){
                    isValid = false;
                    break;
                } else {
                    //Para el primer grupo de claves, lo comprueba
                    for(let i=0; i<keys1.length; i++){
                        if(elements[j][keys1[i]] != this.#formElements[j][keys1[i]]){
                            isValid = false;
                            break;
                        }
                    }
                }
            }
            
            //Si el formulario es válido, envía los datos
            //En caso contrario, ejecuta una posible función de callback
            if(isValid) this.#form.submit();
            else if(this.#callbackOnError) this.#callbackOnError();
        });
    }

    #mapHTMLElements(htmlElement){
        return Array.from(htmlElement).map(element => {
            let attributes = {};
            for(let attribute of element.attributes) attributes[attribute.name] = attribute.value;
            return {
                tagName: element.tagName,
                type: element.type,
                ...attributes,
                checked: element.checked
            };
        });
    }
}