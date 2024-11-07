# infinite-typing-monkey

## Project setup
```
npm install
```

### Compiles and hot-reloads for development
```
npm run serve
```

### Compiles and minifies for production
```
npm run build
```

### Lints and fixes files
```
npm run lint
```

### Customize configuration
See [Configuration Reference](https://cli.vuejs.org/config/).

### Start on server
```
nohup serve -s dist -l 4000 > output.log 2>&1 &
disown
nohup npm run serve:ws > ws_output.log 2>&1 &
disown
```