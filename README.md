# About
This repository provides a back-end service for e-shop written in PHP framework Laravel.  
Further documentation about endpoints can be viewd on [this](https://app.swaggerhub.com/apis/XMALISEK/ASOS_Eshop_2/1.0.0) link

# How to run Back-end
## Clone repo
`git clone https://github.com/ASOS-Semestralny-projekt/Back-end.git`
## Create .env
- Linux/MacOS: `cp .env.example .env`
- Windows Command Prompt: `copy .env.example .env`
- Windows Powershell: `Copy-Item .env.example .env`
## Start app
- docker compose build
- docker compose up
### CAUTION!!! Changed port in request
NGINX port was changed to 83 instead of the default 80 because Windows things...  
example: `localhost:83/products`

