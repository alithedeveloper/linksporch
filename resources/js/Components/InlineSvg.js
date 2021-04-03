import {h} from 'vue';

class Svg {
    constructor(svgMarkup, removeAttrs = false) {
        let div = document.createElement('div');
        div.innerHTML = svgMarkup;

        let fragment = document.createDocumentFragment();
        fragment.append(div);

        this.svg = fragment.querySelector('svg')

        // Remove height and width attributes
        if (removeAttrs) {
            this._removeAttrs();

        }
    }


    _removeAttrs() {
        this.svg.removeAttribute('width')
        this.svg.removeAttribute('height')
    }

    title(title) {
        if (title) {
            this.svg.setAttribute('title', title)
        }
    }

    classes(classes) {
        if (classes) {
            this.svg.classList.remove(...this.svg.classList)
            const classesArray = classes.split(' '); // split "bg-red 500 text-gray"
            this.svg.classList.add(...classesArray)
        }
        return this
    }

    width(width) {
        if (width) {
            this.svg.setAttribute('width', width);
        }
        return this
    }

    height(height) {
        if (height) {
            this.svg.setAttribute('height', height);
        }
        return this
    }

    getHtml() {
        return this.svg.outerHTML
    }
}

export default {
    props: {
        markup: {
            type: String,
            required: true
        },
        tag:{
           type: String,
           default: 'div'
        },
        tagClasses:{
            type: String,
            default: '',
        },
        title: {
            type: String,
            required: false,
            default: null
        },
        classes: {
            type: String,
            required: false,
            default: null
        },
        removeAttributes: {
            type: Boolean,
            default: false
        },
        width: {
            type: Number,
            required: false,
            default: null
        },
        height: {
            type: Number,
            required: false,
            default: null
        },
        isClicked:{
            type: Function,
            default: () => {}
        }
    },
    render() {
        // let tagClasses = this.tagClasses.split(' ')
        return h(this.tag, {
            onClick : $event => this.$emit('isClicked'),
            class : this.tagClasses,
            innerHTML: new Svg(this.markup, this.removeAttributes)
                .classes(this.classes)
                .height(this.height)
                .width(this.width)
                .getHtml()
        })

    }
}
