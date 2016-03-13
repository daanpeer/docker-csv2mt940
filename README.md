# docker-csv2mt940

Convert bankaccount exported CSV-files to the MT940 format.

To run this image:

```
$ docker run --rm -p 8080:80 mpepping/docker-csv2mt940
```

Next up, open a webbrowser to the ip-address of the Dockerhost on port 8080/tcp.


## Credits

The application in this container uses the layout and logic of [denvers/bank-parser](https://github.com/denvers/bank-parser).
