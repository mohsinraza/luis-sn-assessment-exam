# import requests

# url = "https://a.klaviyo.com/api/v2/list/LIST_ID/get-members?api_key=pk_0ddbf9022d7129e7fb4c0734ea0a285f05"

# payload = {
#     "emails": ["george.washington@klaviyo.com", "abraham.lincoln@klaviyo.com"],
#     "phone_numbers": ["+13239169023", "+12028837032"],
#     "push_tokens": ["PUSH_TOKEN_1", "PUSH_TOKEN_2"]
# }
# headers = {
#     "accept": "application/json",
#     "content-type": "application/json"
# }

# response = requests.post(url, json=payload, headers=headers)

# print(response.text)

# import requests

# url = "https://a.klaviyo.com/api/v2/list/Tt8e4M/get-members?api_key=pk_0ddbf9022d7129e7fb4c0734ea0a285f05"

# payload = {
#     "phone_numbers": ["+13239169023", "+12028837032"]
# }
# headers = {
#     "Accept": "application/json",
#     "Content-Type": "application/json"
# }

# response = requests.request("POST", url, json=payload, headers=headers)

# print(response.text)


# import requests
# import json
# data = {
#    "api_key": "pk_0ddbf9022d7129e7fb4c0734ea0a285f05",
#    "profiles": [
#        {
#            "phone_number": "+13478845669",
#            "sms_consent": True
#        }
#    ]
# }
# headers = {
#    "Content-Type": "application/json",
#    "Cache-Control": "no-cache"
#    }
# conv = json.dumps(data)
# response = requests.request("POST", "https://a.klaviyo.com/api/v2/list/Tt8e4M/subscribe", data=conv, headers=headers)
# print(response.text)


import requests

url = "https://a.klaviyo.com/api/profile-subscription-bulk-create-jobs/"

payload = {"data": {
        "type": "profile-subscription-bulk-create-job",
        "attributes": {
            "list_id": "XE5KQ5",
            "custom_source": "Marketing Event",
            "subscriptions": [
                {
                    "channels": {
                        "email": ["MARKETING"],
                        "sms": ["MARKETING"]
                    },
                    "email": "mohsinraza.work@yahoo.com",
                    "phone_number": "+13478845669",
                    "profile_id": "01GY5ZXKXBT6ATDX059C9QQW4F"
                }
            ]
        }
    }}
headers = {
    "accept": "application/json",
    "revision": "2023-02-22",
    "content-type": "application/json",
    "Authorization": "Klaviyo-API-Key pk_0ddbf9022d7129e7fb4c0734ea0a285f05"
}

response = requests.post(url, json=payload, headers=headers)

print(response.text)