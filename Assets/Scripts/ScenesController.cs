using UnityEngine;
using UnityEngine.SceneManagement;

public class ScenesController : MonoBehaviour
{
    public void LoadSaves()
    {
        SceneManager.LoadScene("SavesMenu");
    }

    public void LoadOptions()
    {
        SceneManager.LoadScene("OptionsMenu");
    }
    public void LoadMain()
    {
        SceneManager.LoadScene("MainMenu");
    }
}
