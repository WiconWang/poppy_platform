# poppy_platform Test

# 基于Docker 的  Install
### Docker安装
下载安装Docker主环境

### 新建项目文件夹
mkdir /home/poppy_platform   

### 下拉影像  
docker pull easyswoole/easyswoole3       

### 启动容器
docker run -ti -p 8080:9501  -v /home/poppy_platform:/easyswoole  --name poppy  -d  easyswoole/easyswoole3      
注：如果有网桥，比如dev-net, 可以使用 --net docker_webserver_dev-net接入网桥   

### 启动项目
进入容器： docker exec -it poppy /bin/bash    
启动程序：  php easyswoole start    
然后可以使用 localhost:8080访问项目了。     

### 注释
如果希望使用80端口,则把容器端口改为80，如80被占用可以使用nginx等代理至80端口       
如果希望自动启动，可自行编写 docker-compose

