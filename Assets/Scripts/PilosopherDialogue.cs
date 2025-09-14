using UnityEngine;

[CreateAssetMenu(fileName = "PhilosopherDialogue", menuName = "NPC/PhilosopherDialogue")]
public class PhilosopherDialogue : ScriptableObject
{
    [TextArea(2, 6)]
    public string question;
    public string[] answers;
    public string[] consequences; // opcional: "buff", "karma+", etc.
}