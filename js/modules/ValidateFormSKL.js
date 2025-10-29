/**
 * **ValidateFormSKL**
 * 
 * This class allows you to validate a form and block the sending
 * of the form. Same in case the user modifies it through HTML
 *  with the developer tools. Serves a medium security level
 * @author JuanGV
 * @version 1.0.0
 * @name ValidateFormSKL
 * @license MIT
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
        //Save the initial values, making a copy to avoid changes
        this.#formElements = this.#mapHTMLElements(this.#form.elements);
        
        //Add a listener to the form when data is submitted
        this.#form.addEventListener("submit", (e) => {
            //Avoid sending by default
            e.preventDefault();

            //Makes a copy of items after sending to compare them with the old version
            let elements = this.#mapHTMLElements(this.#form.elements);

            //There is a trigger activated
            let isValid = true;

            //Iterate through each of the elements
            for(let i=0; i<elements.length; i++){
                //Get the key group of a specific element
                let keys1 = Object.keys(elements[i]);
                let keys2 = Object.keys(this.#formElements[i]);

                //If the number of keys is different, activate the error trigger
                if(keys1.length != keys2.length){
                    isValid = false;
                    break; //Break the loop
                } else {
                    //To check by key group
                    for(let j=0; j<keys1.length; j++){
                        //If the content of one is different from the other, activate the error trigger
                        if(elements[i][keys1[j]] != this.#formElements[i][keys1[j]]){
                            isValid = false;
                            break; //Break the loop
                        }
                    }
                }
            }
            
            //If the form is valid, send the data
            //Otherwise, execute a possible callback function
            if(isValid) this.#form.submit();
            else if(this.#callbackOnError) this.#callbackOnError();
        });
    }

    /**
     * Toma un elemento HTML (generalmente del tipo formulario) y lo mapea
     * a un diccionario. No lo genera como referencia, sino como una copia
     * @param {HTMLElement} htmlElements Suele ser un listado de elementos7
     * @returns {Array} Listado de elementos
     * @function
     * @private
     */
    #mapHTMLElements(htmlElements){
        return Array.from(htmlElements).map(element => {
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