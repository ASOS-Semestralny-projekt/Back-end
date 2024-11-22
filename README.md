# How to run project
## Clone repo
`git clone https://github.com/ASOS-Semestralny-projekt/Back-end.git`
## Create .env
- Linux/MacOS: `cp .env.example .env`
- Windows Command Prompt: `copy .env.example .env`
- Windows Powershell: `Copy-Item .env.example .env`
## Start app
- docker compose build
- docker compose up
### CAUTION!!! Change port in request
NGINX port was changed to 83 instead of the default 80 because Windows things...  
example: `localhost:83/products`
