【文件说明】
root.crt:	     			根证书
chain.crt:	     			中级证书
*.crt:	     				服务器证书
*.key:	     				服务器私钥
*.pfx 						部署IIS使用的证书
*_pfx_password.txt		 	IIS证书密码	
readme.txt					说明文件

注：请根据您的应用需求，我们为你准备不同的类型证书文件。

Nginx/Tengine：
*.crt（包含服务器证书和中级证书）
*.key

Apache:
chain.crt
*.crt
*.key

IIS(包括IIS6/7/8):
*.pfx
*_pfx_password.txt

其他（您可以使用这4个文件得到任何你需要的证书类型）：
root.crt:
chain.crt:
*.crt:
*.key:

【安装说明】
支持独立IP虚拟主机和云服务器等，不支持共享IP虚拟主机。