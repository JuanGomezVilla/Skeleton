/**
 * IMPORTANTE: no suelta mensajes al usuario, permite evitar envíos
 * en caso de que el usuario haga un cambio en el HTML
 */
class ValidateForm {

    #form;
    #formElements;

    constructor(form){
        this.#form = form;
        this.#setValidator();
    }

    #setValidator(){
        //Guarda los valores iniciales, realizando una copia para evitar cambios
        this.#formElements = Array.from(this.#form.elements).map(element => {
            const attrs = {};
            for(let attr of element.attributes) attrs[attr.name] = attr.value;
            return {tagName: element.tagName, type: element.type, ...attrs, checked: element.checked};
        });
        
        //Añade un listener al formulario cuando se envíen los datos
        this.#form.addEventListener("submit", (e) => {
            //Evitar por defecto el envío
            e.preventDefault();

            let elements = Array.from(this.#form.elements).map(element => {
                const attrs = {};
                for(let attr of el.attributes) attrs[attr.name] = attr.value;
                return {tagName: element.tagName, type: element.type, ...attrs, checked: element.checked};
            });


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

            if(isValid) console.log("Formulario valido");
            else console.warn("Invalido");
        
            //if(isValid) this.#formulario.submit();
        });
    }
}