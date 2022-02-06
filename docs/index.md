# Documentation

## Examples

See [examples](./examples) folder (*work in progress*)

## Reference

[References](./references/index.html)

## Building documentation

Install PHPDocumentor

```shell
curl -LO https://phpdoc.org/phpDocumentor.phar
chmod u+x phgDocumentor.phar
```

Build (*from project root folder*)

```shell
./phpDocumentor.phar -d core -t docs/reference
```

**Documentation**: https://docs.phpdoc.org/3.0/guide/getting-started/installing.html