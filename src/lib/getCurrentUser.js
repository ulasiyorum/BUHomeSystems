export default async function getCurrentUser() {
    
    const url = "http://localhost/Home-System-main/BUHomeSystems/register-packages/app-pages/admin.php";

    const data = await fetch(url
    , { mode:"cors" });
    
    return data.json();
}   