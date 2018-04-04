# wordpressapi

Project to create empty theme of wordpress and add custom RESTful api.

## To use this theme
1 setup a wordpress website (version >= 4.9)  
2 create a folder with a name you like in wp-content/themes  
3 inside the folder created in previous step, checkout this repo  
4 go to wordpress admin dashboard, enable the theme at Appearance>Themes (the theme with the name in step 2)  
5 To call the api to list custom post type Project, use:  

```
<your_domain>/wp-json/test/v1/projects
```
  To search Project with project title, use:

```
<your_domain>/wp-json/test/v1/projects?search=<title>
```
