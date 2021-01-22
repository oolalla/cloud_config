import boto3

service_name = 's3'
endpoint_url = 'https://kr.object.ncloudstorage.com'
region_name = 'kr-standard'
access_key = '5330500D81401E3CBACF'
secret_key = '47A8FEE8FBF383C06953536FBB647A5CD921B990'

if __name__ == "__main__":
    s3 = boto3.client(service_name, endpoint_url=endpoint_url, aws_access_key_id=access_key,
                      aws_secret_access_key=secret_key)

    bucket_name = 'test-obect-bucket'

 # create folder
    object_name = 'test-folder/'

    s3.delete_object(Bucket=bucket_name, Key=object_name)
