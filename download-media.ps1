$ErrorActionPreference = "Stop"

# Create directories if they don't exist
New-Item -ItemType Directory -Force -Path "assets\images"
New-Item -ItemType Directory -Force -Path "assets\videos"

# Function to download file
function Download-File {
    param (
        [string]$Url,
        [string]$OutputPath
    )
    Write-Host "Downloading $Url to $OutputPath"
    Invoke-WebRequest -Uri $Url -OutFile $OutputPath
}

# Download room images
$images = @{
    "standard-room.jpg" = "https://images.pexels.com/photos/271624/pexels-photo-271624.jpeg"
    "deluxe-room.jpg" = "https://images.pexels.com/photos/164595/pexels-photo-164595.jpeg"
    "suite-room.jpg" = "https://images.pexels.com/photos/1743229/pexels-photo-1743229.jpeg"
    "family-suite.jpg" = "https://images.pexels.com/photos/3659683/pexels-photo-3659683.jpeg"
    "ocean-view.jpg" = "https://images.pexels.com/photos/2598638/pexels-photo-2598638.jpeg"
    "penthouse.jpg" = "https://images.pexels.com/photos/1571460/pexels-photo-1571460.jpeg"
    "garden-villa.jpg" = "https://images.pexels.com/photos/338504/pexels-photo-338504.jpeg"
    "honeymoon-suite.jpg" = "https://images.pexels.com/photos/3754595/pexels-photo-3754595.jpeg"
}

foreach ($image in $images.GetEnumerator()) {
    Download-File -Url $image.Value -OutputPath "assets\images\$($image.Key)"
}

# Download hotel background video
Download-File -Url "https://player.vimeo.com/external/420141297.hd.mp4?s=4c6e40b6f4e8a4a8f3adac6ccb9e2a6c68bb8434&profile_id=175" -OutputPath "assets\videos\hotel-bg.mp4"

Write-Host "All media files have been downloaded successfully!"
