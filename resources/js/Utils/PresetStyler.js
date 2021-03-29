export default class PresetStyler {
    constructor(preset) {
        this.preset = preset
    }

    _buildStyles() {
        let styles = {}
        switch (this.preset) {
            case 'pink':
                this.pinkPresetStyles(styles);
                return styles
        }

    }

    pinkPresetStyles(styles) {
        styles.background = '#FB6ABD'
        styles.linkColor = '#FCF9F9'
        styles.linkTextColor = '#FC409C'
        styles.textColor = '#FCF9F9'
    }

    get styles(){
        return this._buildStyles();
        // return JSON.parse(this.styles)
    }

}
