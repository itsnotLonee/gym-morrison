# vue-blink

> A Vue.js component that blinks!

## Usage

Install:
```bash
npm install vue-blink-css
```
Import:
```javascript
import VueBlink from 'vue-blink-css'
Vue.use(VueBlink)
```

```xml
<VueBlink :duration="5">Blinking Text</VueBlink>
<VueBlink :duration="1">Blink is back!</VueBlink>
<VueBlink
  :duration="1.5"
  :iterationCount="5">
  <p>This is super annoying!</p>
</VueBlink>
```

## Build Setup

``` bash
# install dependencies
npm install

# serve with hot reload at localhost:8080
npm run dev

# build for production with minification
npm run build
```
